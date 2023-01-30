@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="category.html">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Category Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow my-5">
                                    <td>1</td>
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27 02:12</td>
                                    <td>
                                        CRUD
                                    </td>
                                </tr>
                                <tr class="tr-shadow my-5">
                                    <td>1</td>
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27 02:12</td>
                                    <td>
                                        CRUD
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
