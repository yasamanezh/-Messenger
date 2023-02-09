<div>
    <livewire:front.page.layout.title :title="$this->getTranslate('title',$page)" />
          <!-- Start How It Works Area -->
        <div class="how-it-works-area ptb-100">
            <div class="container">
                @foreach($steps as $key=>$step)
                <div class="how-it-works-content">
                    <div class="number">{{$key+1}}</div>
                    <div class="row m-0">
                        <div class="col-lg-3 col-md-12 p-0">
                            <div class="box">
                                <h3>{{$this->getTranslate('title',$step)}}</h3>
                                <span>{{$this->getTranslate('short_content',$step)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12 p-0">
                            <div class="content">
                                {!! $this->getTranslate('content',$step) !!}
                                <img src="/storage/{{$step->image}}" alt="create-account">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <!-- End How It Works Area -->
           <livewire:front.module.download1 />


</div>