<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Task, Categories};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function list()
    {
        return view('list');
    }

    public function store(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'todos' => 'required|string' // Memastikan todos diterima sebagai string
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Menggunakan transaksi untuk memastikan semua operasi berhasil
        DB::beginTransaction();

        try {
            // Simpan atau ambil user data
            $user = User::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'username' => $request->username,
                    'created_by' => $request->username // Menyimpan username sebagai created_by
                ]
            );

            // Mengambil dan mendekode todos
            $tasks = json_decode($request->todos, true);

            // Validasi jika decoding gagal
            if (!is_array($tasks)) {
                throw new \Exception('Invalid todos data format.');
            }

            // Simpan To-Do items
            foreach ($tasks as $taskData) {
                Task::create([
                    'user_id' => $user->id,
                    'category_id' => $taskData['category'],
                    'description' => $taskData['title'],
                    'created_by' => $request->username // Menyimpan username sebagai created_by
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Data berhasil disimpan!'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.', 'error' => $e->getMessage()], 500);
        }
    }

    public function getAllCategory()
    {
        return Categories::all();
    }

    public function getAllTodo(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::with('user', 'category')->select('*')->orderBy('created_at', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function($row){
                    return $row->user->name ?? 'N/A'; // Menampilkan nama pengguna
                })
                ->addColumn('description', function($row){
                    return $row->description;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('status', function($row){
                    switch($row->category->name) {
                        case 'Pending':
                            return '<span class="badge bg-light-warning text-warning px-3 py-2">Pending</span>';
                        case 'InProgress':
                            return '<span class="badge bg-light-primary text-primary px-3 py-2">In Progress</span>';
                        case 'Testing':
                            return '<span class="badge bg-light-info text-info px-3 py-2">Testing</span>';
                        case 'Done':
                            return '<span class="badge bg-light-success text-success px-3 py-2">Done</span>';
                        case 'Todo':
                            return '<span class="badge bg-light-secondary text-dark px-3 py-2">To Do</span>';
                        default:
                            return '<span class="badge bg-light-secondary text-dark px-3 py-2">Unknown</span>';
                    }
                })
                ->addColumn('action', function($row){
                    return '
                        <button class="btn btn-danger btn-sm delete-task" data-id="'.$row->id.'"><i class="ki-outline ki-trash"></i></button>
                    ';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search')) {
                        $search = $request->get('search')['value'];
                        if (!empty($search)) {
                            $query->where('description', 'LIKE', "%$search%");
                        }
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function delete($id)
    {
        try {
            // Temukan task dulu berdasarkan ID
            $task = Task::findOrFail($id);
            $userId = $task->user_id;

            // Hapus task
            $task->delete();

            // Cek jika user tidak punya task lagi
            $remainingTasks = Task::where('user_id', $userId)->count();

            if ($remainingTasks === 0) {
                User::findOrFail($userId)->delete();
            }

            DB::commit();

            // Return response sukses
            return response()->json(['message' => 'Data berhasil dihapus!'], 200);
        } catch (\Exception $e) {
            // Return response error jika gagal
            return response()->json(['message' => 'Data gagal dihapus.', 'error' => $e->getMessage()], 500);
        }
    }
}
