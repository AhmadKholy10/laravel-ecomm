@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : 'Settings')
@section('content')
    
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Settings 
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">dashboard </li>
                        <li class="breadcrumb-item active">settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row product-adding">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="digital-add needs-validation">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                @if($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif

                            <div class="form-group">
                                <label for="validationCustom05" class="col-form-label pt-0">
                                    logo </label>
                                <input class="form-control" id="validationCustom05" type="file" name="logo">
                                <img src="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">favicon </label>
                                <input class="form-control" id="validationCustom05" type="file" name="favicon">
                                <img src="">
                            </div>



                            <div class="form-group">
                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                    site name </label>
                                <input class="form-control" id="validationCustom01" type="text" name="name" value="">
                            </div>


                            <div class="form-group">
                                <label class="col-form-label">description </label>
                                <textarea rows="3" cols="12" name="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02" class="col-form-label"><span>*</span>
                                    email  </label>
                                <input class="form-control" id="validationCustom02" type="text" name="email" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">phone </label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="phone" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">address</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="address" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0"> facebook  </label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="facebook" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">twitter </label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="twitter" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">instagram </label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="instagram" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0"> youtube</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="youtube" value="">
                            </div>


                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">tiktok </label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="tiktok" value="">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">save</button>
                            </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection