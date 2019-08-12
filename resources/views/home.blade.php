@extends('layouts.master')

@section('content')
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        @foreach($posts as $post)
        <div class="post-content">
        <!-- Title -->
        <h1 class="mt-4">{{$post->subject}}</h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#">{{$post->user->name}}</a>
        </p>
        @if(count($post->posttags) !== 0)
        Tags : 

        @foreach($post->posttags as $posttag)
        <a href="{{URL('search-result/?tag='.$posttag->tags->name.'&key_word=')}}"><span class="badge badge-info">{{$posttag->tags->name}}</span></a>
        @endforeach
        @endif
        <hr>

        <!-- Date/Time -->
        <p>Posted on {{$post->created_at}}</p>

        <hr>

        <!-- Preview Image -->
        <!-- <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

        <hr> -->

        <!-- Post Content -->
        <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p> -->

        <p>{{$post->description}}</p>

        <blockquote class="blockquote">
          
          <footer class="blockquote-footer">
            <!-- Someone famous in -->
            <cite title="Source Title">{{$post->user->name}}</cite>
          </footer>

        </blockquote>

        @if(Auth::check())
        @if(Auth::user()->id == $post->user_id || Auth::user()->role == 'admin')
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-id="{{$post->id}}" onclick="viewforEdit({{$post->id}})">Edit</button>
        <button type="button" class="btn btn-danger" onclick="deletePost({{$post->id}})">Delete</button>
        @endif
        @endif
        <hr>
        </div>
        @endforeach

        @if(Auth::check())
        <!-- New Post Form -->
        <div class="card my-4">
          <h5 class="card-header">Submit a New Post:</h5>
          <div class="card-body">
            <form id="postform">
                <div class="form-group">
                <input class="form-control" name="subject" value="" placeholder="Enter Your Subject" required>
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Type your post" name="description" required></textarea>
              </div>
              <div class="form-group">
            <label>Tags:</label>
            <br/>
            <input class="form-control" id="tags" data-role="tagsinput" type="text" name="tags[]" required>
            <!-- @if ($errors->has('tags'))
                <span class="text-danger">{{ $errors->first('tags') }}</span>
            @endif -->
        </div>      
             
              <button type="button" class="btn btn-primary" onclick="submitform()">Submit</button>
            </form>
          </div>
        </div>
        @else
        <div class="card my-4">
          <h5 class="card-header">Login to submit a new post</h5>
          <div class="card-body">
            <p>Please login to submit a new post.</p>
          </div>
        </div>



        @endif

        

      </div>


      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <form method="GET" action="{{URL('search-result')}}">
              <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for..." name="key_word">
              <input type="hidden" class="form-control"  name="tag">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
            </div>

            </form>
            
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Popular Tags</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                    @foreach($tags as $tag)
                  <li>
                    <a href="{{URL('search-result/?tag='.$tag->name.'&key_word=')}}">{{$tag->name}}</a>
                  </li>
                  @endforeach
                  <!-- <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li> -->
                </ul>
              </div>
              <!-- <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div> -->
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
            @if(Auth::check())
            @if (Auth::user()->role == 'admin')
          <h5 class="card-header">Hello Super Admin</h5>
          @else
          <h5 class="card-header">Hello {{Auth::user()->name}}</h5>

        @endif
        @else
        <h5 class="card-header">Please Login</h5>

        @endif
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
  <!-- include post edit modal here -->
  @include('includes.posteditmodal')
  @include('includes.success')

@endsection

