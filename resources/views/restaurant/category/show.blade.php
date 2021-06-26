@extends('layouts.app', ['title' => __('Food Category')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Food Category') }}</h3>
                            </div>
                            @if(auth()->user()->role_id == 1)
                                <div class="col-4 text-right">
                                    <a href="{{ route('category.create' ) }}" class="btn btn-sm btn-primary" style="margin-top: 2rem; margin-right: 1rem;">{{ __('Add Category') }}</a>
                                </div>
                            @endif
                        </div>
                        <hr>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Category Name') }}</th>
                                <th scope="col">{{ __('Picture') }}</th>
                                <th scope="col">{{ __('Options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td><div class="card-img"><img src="/images/category/{{ $category->category_pic }}" style="width:80px; height:80px;"/></div></td>
                                    <td class="text-right">
                                        <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn-warning" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $categories->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection