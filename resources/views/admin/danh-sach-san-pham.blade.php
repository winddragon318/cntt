@extends('admin.layout')
    @section('title', 'Danh sách sản phẩm')
    @section('content')
    <article>
        <div class="overlay-menu"></div>
        <section class="manager">
          <div class="container-fluid">
            <div class="btn-top text-center">
              <button class="btn btn-primary waves-effect"><a href="{{ route('admin.them-san-pham') }}">Thêm mới</a></button>
              <button class="btn btn-success waves-effect" id="active-all" disabled="disabled">Hiển thị toàn bộ</button>
              <button class="btn btn-warning waves-effect" id="private-all" disabled="disabled">Ẩn toàn bộ</button>
              <button class="btn btn-danger waves-effect" id="delete-all" disabled="disabled">Xóa toàn bộ</button>
              <button class="btn btn-info waves-effect" id="go-trash">Dọn rác</button>
            </div>
            <div class="table-responsive">
              <div class="filter-category">
                <select class="form-control" onchange="filterCategory()">
                  <option value="">Chọn danh mục</option>
                  <option value="January">January</option>
                  <option value="---October">---October</option>
                  <option value="--August">--August</option>
                  <option value="June">June</option>
                </select>
              </div>
              <table class="table table-bordered display table-hover product-table" style="width: 100%">
                <thead>
                  <tr>
                    <th style="width: 20px" scope="col">
                      <label class="check-box" style="margin-top: -17px">
                        <input id="check-all" type="checkbox"/><span class="checkmark"></span>
                      </label>
                    </th>
                    <th scope="col">Mã</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Hành động</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </section>
      </article>
    @endsection
