@extends('admin.layout')
    @section('title', 'Thêm sản phẩm')
    @section('content')
    <article>
       <div class="overlay-menu"></div>
        <section class="add-item">
          <div class="container-fluid">
            <div class="title-page">
              <h1> <a>Cấu hình tổng quát</a></h1>
            </div>
            <form action="">
              <select class="form-control mb-4" id="select-status">
                <option value="">Hiển thị</option>
                <option value="">Ẩn</option>
                <option value="">Xóa</option>
              </select>
              <select class="form-control mb-4" id="select-category">
                <option value="">Danh mục cha</option>
                <option value="">Danh mục cha</option>
                <option value="">Danh mục cha</option>
                <option value="">Danh mục cha</option>
                <option value="">Danh mục cha</option>
              </select>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-6">
                    <label class="check-box mb-2">
                      <input type="checkbox"/><span class="checkmark"></span>Sản phẩm bán chạy
                    </label>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <label class="check-box mb-2">
                      <input type="checkbox"/><span class="checkmark"></span>Sản phẩm nổi bật
                    </label>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <label class="check-box mb-2">
                      <input type="checkbox"/><span class="checkmark"></span><span>Sản phẩm mới</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-6">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" id="radio1" type="radio" name="groupOfDefaultRadios"/>
                      <label class="custom-control-label" for="radio1">Option 1</label>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" id="radio2" type="radio" name="groupOfDefaultRadios"/>
                      <label class="custom-control-label" for="radio2">Option 1</label>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" id="radio3" type="radio" name="groupOfDefaultRadios"/>
                      <label class="custom-control-label" for="radio3">Option 1</label>
                    </div>
                  </div>
                </div>
              </div>
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
              <div class="md-form mb-3">
                <input class="form-control form-control-sm" id="date-time" type="text"/>
                <label for="date-time">Ngày giờ</label>
              </div>
              <div class="form-group mt-4 mb-3">
                <div id="toolbar-container"></div>
                <div id="editor"></div>
              </div>
              <div class="text-center">
                <button class="btn btn-primary mr-3">Lưu lại</button><a class="btn btn-light" href="bang-dieu-khien.html">Trở về</a>
              </div>
            </form>
          </div>
        </section>
      </article>
    @endsection
