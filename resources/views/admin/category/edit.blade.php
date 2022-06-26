<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
            </b>
        </h2>

    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            Edit Category
                        </div>
                        <div class="card-body">
                            <form action="{{ url("category/update/$categories->id") }}" method="POST">
                                @csrf
                                <div class="form-group">
                                <label for="exampleInputEmail1">Update Category Name</label>
                                <input type="text" class="form-control"
                                name="category_name"
                                id="InputCategory"
                                aria-describedby="emailHelp"
                                placeholder="Category"
                                value="{{ $categories->category_name }}">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>

                                <button type="submit" class="btn btn-block btn-primary">Update Category</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>

