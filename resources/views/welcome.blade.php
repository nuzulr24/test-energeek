@include('layout.header')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h6 class="card-title">To-Do</h6>
                    <button class="btn btn-light-primary ms-auto" id="add-task-input">Tambah Data</button>
                </div>
                <div class="card-body">
                    <form id="todo-form" method="POST" action="{{ route('api.todo.add') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama</label>
                                <input type="text" class="form-control mt-2" name="name" required>
                            </div>
                            <div class="col-md-4">
                                <label>Alamat Email</label>
                                <input type="email" class="form-control mt-2" name="email" required>
                            </div>
                            <div class="col-md-4">
                                <label>Username</label>
                                <input type="text" class="form-control mt-2" name="username" required>
                            </div>
                        </div>

                        <!-- Add To-Do Items Here -->
                        <div id="todo-list"></div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var categories = [];
        $.ajax({
            url: '{{ route('api.category.list') }}',
            method: 'GET',
            success: function(data) {
                categories = data;
            },
            error: function(xhr) {
                console.error("Gagal mengambil daftar kategori:", xhr.responseText);
            }
        });

        $('#todo-form').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serializeArray();
            var todos = [];

            $('#todo-list .new-task-form').each(function() {
                var title = $(this).find('input[name="title[]"]').val();
                var category = parseInt($(this).find('select[name="category[]"]').val(), 10);
                todos.push({ title: title, category: category });
            });

            // Validasi di sisi klien: Pastikan ada minimal 1 todo item
            if (todos.length === 0) {
                Swal.fire({
                    text: 'Kamu harus menambahkan setidaknya satu To-Do.',
                    icon: 'warning',
                    buttonsStyling: false,
                    confirmButtonText: 'Baik',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    }
                });
                return;
            }

            formData.push({ name: 'todos', value: JSON.stringify(todos) });

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $.param(formData),
                success: function(response) {
                    Swal.fire({
                        text: response.message,
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'Baik',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    }).then(() => {
                        $('#todo-form')[0].reset();
                        $('#todo-list').empty();
                    });
                },
                error: function(xhr) {
                    var errorMessage = 'Terjadi kesalahan.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value.join(' ') + ' ';
                        });
                    }

                    Swal.fire({
                        text: errorMessage.trim(),
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Baik',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                }
            });
        });

        $('#add-task-input').on('click', function() {
            var newTaskForm = `
                <div class="row mt-5 new-task-form">
                    <div class="col-md-7">
                        <label>Judul To-Do</label>
                        <input type="text" class="form-control mt-2" name="title[]" required>
                    </div>
                    <div class="col-md-3">
                        <label>Kategori To-Do</label>
                        <select class="form-control mt-2" name="category[]" required>
                            ${categories.map(category => `<option value="${category.id}">${category.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger mt-2 delete-task-form"><i class="ki-outline ki-trash"></i></button>
                    </div>
                </div>
            `;
            $('#todo-list').append(newTaskForm);
        });

        $(document).on('click', '.delete-task-form', function() {
            $(this).closest('.new-task-form').remove();
        });

        $(document).on('click', '.delete-task', function() {
            $(this).closest('.todo-item').remove();
        });
    });
</script>
