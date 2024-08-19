@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@include('layout.header')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h6 class="card-title">Daftar To-Do</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped border rounded gy-5 gs-7">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th data-priority="1">ID</th>
                                    <th data-priority="2">Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat</th>
                                    <th data-priority="3">Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('api.todo.list') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user', name: 'user' },
                { data: 'description', name: 'description' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $(document).on('click', '.delete-task', function() {
            var id = $(this).data('id');
            Swal.fire({
                text: "Kamu yakin ingin menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batalkan",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/todo/${id}/delete`,
                        method: 'GET',
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
                                $('#data-table').DataTable().ajax.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                text: 'Terjadi kesalahan pada saat menghapus',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Baik',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>
