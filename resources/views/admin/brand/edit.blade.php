<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Brand
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
                            Edit Brand
                        </div>
                        <div class="card-body">
                            <form action="{{url("brand/update/$brands->id") }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Update Brand Name</label>
                                <input type="text" class="form-control"
                                name="brand_name"
                                id="InputBrand"
                                aria-describedby="emailHelp"
                                placeholder="Brand"
                                value="{{ $brands->brand_name }}">
                                @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset($brands->brand_image) }}" style="width:400px; height:200px" alt="{{ $brands->brand_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Image</label>
                                    <input type="file" class="form-control" name="brand_image" id="InputBrand" aria-describedby="emailHelp" placeholder="Brand Name">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-block btn-primary">Update Brand</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>

