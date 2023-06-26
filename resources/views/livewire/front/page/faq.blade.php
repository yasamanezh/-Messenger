<div>
    @if($page)
        <livewire:front.layout.menu :lang="$multiLanguage">
            <!-- Start Page Title Area -->
            <div class="page-title-area">
                <div class="container">
                    <div class="page-title-content">
                        <h2>{{$this->getTranslate('title',$page)}}</h2>
                        <ul>
                            <li>
                                <a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a>
                            </li>
                            <li>{{$this->getTranslate('title',$page)}}</li>
                        </ul>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="lines">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <div class="banner-shape1">
                    <img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}"
                         alt="{{$this->getTranslate('title',$page)}}">
                </div>
            </div>
            <!-- Start FAQ Area -->
            <div class="faq-area ptb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="faq-sidebar">
                                    @foreach($parents as $y =>$parent)
                                            <button style="background: transparent" class="accordion-button collapsed"
                                                    type="button" data-target="#collapse-{{$parent->id}}"
                                                    aria-expanded="false" data-toggle="collapse">
                                                <span>{{$this->getTranslate('title',$parent)}}</span>
                                            </button>
                                        <div id="collapse-{{$parent->id}}"
                                             class="accordion-collapse m-2  collapsed "
                                             aria-labelledby="flush-{{$parent->id}}"
                                             data-bs-parent="#{{$parent->id}}">
                                            <ul>
                                                <div role="tablist" aria-orientation="vertical">
                                                    @php $childrens = $this->children($parent->id)  @endphp
                                                    @if($childrens)
                                                        @foreach($childrens as $x =>$child)
                                                            <li>
                                                            <a class="tablinks {{$y==0 && $x==0 ? 'show active' : ''}}" style="cursor: pointer;"
                                                                    onclick="openCity(event, 'tab-{{$child->id}}')">{{$this->getTranslate('title',$child)}}</a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </ul>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <div class="faq-accordion accordion" id="faqAccordion">
                                @foreach($allCategory as $cat)
                                    <div class="tabcontent"
                                         id="tab-{{$cat->id}}" style="display: {{$loop->first ? 'block' : 'none'}};">
                                        @php $faqs =$this->faqs($cat->id)  @endphp
                                        @foreach($faqs as $faq)
                                            <div class="accordion-item">
                                                <button class="accordion-button {{$loop->first ? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#faq{{$faq->id}}" aria-expanded="true"
                                                        aria-controls="faq{{$faq->id}}"> {{$this->getTranslate('title',$faq)}}</button>
                                                <div id="faq{{$faq->id}}"
                                                     class="accordion-collapse collapse {{$loop->first ? 'show' : ''}}"
                                                     data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body">
                                                        {{$this->getTranslate('short_content',$faq)}}
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function openCity(evt, cityName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" show active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " show active";
                }
            </script>
            <!-- End FAQ Area -->
            <livewire:front.layout.footer :language="$multiLanguage">
    @endif
</div>