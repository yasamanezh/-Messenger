<div class="comments-area">
    <style>
        .blog-details-desc .comments-area .comment-respond .form-submit button {
            border: none;
            cursor: pointer;
            padding: 10px 30px;
            display: inline-block;
            color: var(--whiteColor);
            background: var(--mainColor);
            -webkit-transition: var(--transition);
            transition: var(--transition);
            font-weight: 600;
            font-size: var(--fontSize);
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #f44761;
            border-color: #f44761;
        }
    </style>
    <h3 class="comments-title"> {{count($post->comments)}} {{__('Comments')}}:</h3>
    @foreach($comments as $item)

    <ol class="comment-list">
        <li class="comment">
            <div class="comment-body">
                <footer class="comment-meta">
                    <div class="comment-author vcard">
                        <img src="{{asset('front/ltr/assets/img/user/user1.jpg')}}" class="avatar" alt="{{$item->name}}">
                        <b class="fn">{{$item->name}}</b>
                    </div>
                    <div class="comment-metadata">
                        <span>{{$item->created_at->format('M d , Y h:s A')}}</span>
                    </div>
                </footer>
                <div class="comment-content">
                    <p>{{$item->content}}</p>
                </div>

            </div>
            @php $answers =$this->answer($item->id); @endphp
            
            @if($answers)
          

            @foreach($answers as $answer)
            <ol class="children">
                <li class="comment">
                    <div class="comment-body">
                        <footer class="comment-meta">
                            <div class="comment-author vcard">
                                <img src="{{asset('front/ltr/assets/img/user/user2.jpg')}}" class="avatar" alt="{{$item->name}}">
                                <b class="fn">{{$item->name}}</b>
                            </div>
                            <div class="comment-metadata">
                                <span>{{$answer->created_at->format('M d , Y')}}</span>
                            </div>
                        </footer>
                        <div class="comment-content">
                            <p>{{$answer->content}}</p>
                        </div>

                    </div>

                </li>
            </ol>
            @endforeach
            @endif

        </li>

    </ol>
    @endforeach
    <div class="col-lg-12 col-md-12">
        {{$comments->links()}}
    </div>

    <div class="comment-respond">
        <h3 class="comment-reply-title">{{__('message.Leave A Reply')}}</h3>
        <div class="comment-form">
            <p class="comment-notes">
                <span id="email-notes">{{__('message.Your email address will not be published')}}.</span>
                {{__('message. Required fields are marked')}} <span class="required">*</span>
            </p>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>

            @endif
            @if($success)
            <div class="alert alert-success">
                <ul>
                   
                    <li>{{__('success')}}</li>
                   
                </ul>
            </div>

            @endif
                
            

            <p class="comment-form-author">
                <label>{{__('Name')}}</label>
                <input type="text" id="author" placeholder="{{__('Name')}}*"  wire:model.defer="name">
            </p>
            <p class="comment-form-email">
                <label>{{__('Email')}} <span class="required">*</span></label>
                <input type="email" id="email" placeholder="{{__('Email')}}*"  wire:model.defer="email">
            </p>
            <p class="comment-form-url">
                <label>{{__('Website')}}</label>
                <input type="url" id="url" placeholder="{{__('Website')}}" wire:model.defer="website">
            </p>
            <p class="comment-form-comment">
                <label>{{__('Comment')}}<span class="required">*</span></label>
                <textarea wire:model.defer="comment" id="comment" cols="45" placeholder="{{__('Your Comment')}}..." rows="5" ></textarea>

            </p>

            <p class="form-submit">
                <button wire:click.prevent="saveComment()" wire:loading.remove   id="submit" class="submit" type="button" >{{__('message.send comment')}}</button>
            <div  wire:loading  class="spinner-border text-danger" role="status">
                <span class="visually-hidden">{{__('Loading')}}..</span>
            </div>
            </p>
        </div>
    </div>

</div>