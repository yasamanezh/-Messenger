<div>
  <div class="funfacts-area pb-75">
            <div class="container">
                <div class="row justify-content-center">
                     @foreach($modules as $key=>$item)
                    <div class="col-lg-3 col-sm-6 col-md-6">
                        <div class="funfacts-box @if($key+1 == 2) bg1 @elseif($key+1 == 3) bg2  @elseif($key+1 == 4) bg3 @endif">
                            <div class="icon">
                                <i class="ri-download-2-line"></i>
                            </div>
                            <p>{{$this->getTranslate('title',$item)}}</p>
                            <h3><span class="odometer" data-count="{{$item->customTranslate('en')->short_content}}">00</span><span class="sign">{{$this->getTranslate('content',$item)}}</span></h3>
                        </div>
                    </div>
                       @endforeach
                </div>
            </div>
        </div>
</div>
