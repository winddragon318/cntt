@extends('admin.layout')
    @section('title', 'Cấu hình tổng quát')
    @section('content')
    <article>
       <div class="overlay-menu"></div>
        <section class="dashboard">
          <div class="container-fluid">
            <div class="title-page">
              <h1> <a>Cấu hình tổng quát</a></h1>
            </div>
            <form action="">
              <div class="md-form mb-3">
                <input class="form-control form-control-sm" id="titleSite" type="text"/>
                <label for="titleSite">Title Site</label>
              </div>
              <div class="md-form mb-3">
                <input class="form-control form-control-sm" id="titleSite1" type="text"/>
                <label for="titleSite1">Keywords Site</label>
              </div>
              <div class="md-form mb-3">
                <textarea class="md-textarea form-control" id="descSite" rows="5"></textarea>
                <label for="descSite">Description Site</label>
              </div>
              <div class="md-form mb-3">
                <input class="form-control form-control-sm" id="code" type="text"/>
                <label for="code">Mã số thuế</label>
              </div>
              <div class="text-center">
                <button class="btn btn-primary mr-3">Lưu lại</button><a class="btn btn-light" href="{{ route('admin.bang-dieu-khien') }}">Trở về</a>
              </div>
            </form>
          </div>
        </section>
      </article>
    @endsection
