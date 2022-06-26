<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Categories
            </b>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <h3>All Categories</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @php ($i = 1) --}}
                                    @foreach ($categories as $category )
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                        @if ($category->created_at == NULL)
                                            <span class="text-danger"> No Date Set</span>
                                        @else
                                            {{ $category->created_at->diffForHumans() }}
                                        </td>
                                        @endif
                                        <td>
                                            <a href="{{ url("category/edit/$category->id") }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url("category/soft-delete/$category->id") }}" class="btn btn-danger">Trash</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Categories
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" class="form-control" name="category_name" id="InputCategory" aria-describedby="emailHelp" placeholder="Category">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($trash) > 0)
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            @if(session('trash-sucess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <h3>Trash</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Deleted At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trash as $trashcategory )
                                    <tr>
                                        <th scope="row">{{ $trash->firstItem()+$loop->index }}</th>
                                        <td>{{ $trashcategory->category_name }}</td>
                                        <td>{{ $trashcategory->user->name }}</td>
                                        <td>
                                        @if ($trashcategory->created_at == NULL)
                                            <span class="text-danger"> No Date Set</span>
                                        @else
                                            {{ $trashcategory->deleted_at->diffForHumans() }}
                                        </td>
                                        @endif
                                        <td>
                                            <a href="{{ url("category/restore/$trashcategory->id") }}" class="btn btn-sucess">Restore</a>
                                            <a href="{{ url("category/delete/$trashcategory->id") }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $trash->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
