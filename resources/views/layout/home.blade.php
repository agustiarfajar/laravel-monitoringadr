@extends('layout.master')

@section('sidebar')

<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="/">
      <i class="bi bi-grid"></i>
      <span>Home</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/faq">
      <i class="bi bi-question-circle"></i>
      <span>F.A.Q</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-contact.html">
      <i class="bi bi-envelope"></i>
      <span>Contact</span>
    </a>
  </li><!-- End Contact Page Nav -->

</ul>

</aside>
@endsection

@section('content')

        <div class="" style="width: 18 rem;">

          <div class="alert alert-info alert-dismissible fade show" role="alert">
            A simple info alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Selamat Datang!</h5>
              Ut in ea error laudantium quas omnis officia. Sit sed praesentium voluptas. Corrupti inventore consequatur nisi necessitatibus modi consequuntur soluta id. Enim autem est esse natus assumenda. Non sunt dignissimos officiis expedita. Consequatur sint repellendus voluptas.
              Quidem sit est nulla ullam. Suscipit debitis ullam iusto dolorem animi dolorem numquam. Enim fuga ipsum dolor nulla quia ut.
              Rerum dolor voluptatem et deleniti libero totam numquam nobis distinctio. Sit sint aut. Consequatur rerum in.
              <br><br><a href="/faq" type="btn btn-dark" class="btn btn-dark"><i class="bi bi-question-circle"></i> F.A.Q</a>
            </div>
          </div>

          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Login terlebih dahulu</h5>
              Lakukan login untuk mengakses halaman monitoring pengiriman.
              <br><br><a href="/login" type="btn btn-primary" class="btn btn-primary"><i class="bi bi-person"></i> Login</a>
            </div>
          </div>
        </div>
@endsection

