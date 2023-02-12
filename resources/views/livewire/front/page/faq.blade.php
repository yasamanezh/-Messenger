<div>
    <livewire:front.layout.menu :lang="$multiLanguage">
        <livewire:front.page.layout.title :title="$this->getTranslate('title',$page)" />
            <!-- Start FAQ Area -->
            <div class="faq-area ptb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="faq-sidebar">
                                <ul>
                                    @foreach($parents as $parent)
                                    <li>
                                        <button style="background: transparent" class="accordion-button {{$loop->first ? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$parent->id}}" aria-expanded="false" aria-controls="collapse-{{$parent->id}}" >
                                            <span>{{$this->getTranslate('title',$parent)}}</span>
                                        </button>
                                    </li>
                                    @php $childrens = $this->children($parent->id)  @endphp
                                    @if($childrens)
                                    <div id="collapse-{{$parent->id}}" class="accordion-collapse m-2 {{$loop->first ? '' : 'collapsed'}} " aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="d-flex align-items-start">
                                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                                @foreach($childrens as $child)
                                                <button class="nav-link {{$loop->first ? 'active' : ''}}" id="home{{$child->id}}-tab" data-bs-toggle="tab" data-bs-target="#tab-{{$child->id}}" type="button" role="tab" aria-controls="home{{$child->id}}" aria-selected="false">{{$this->getTranslate('title',$child)}}</button>

                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">

                            <div class="tab-content">
                                @foreach($allCategory as $cat)

                                <div class="tab-pane fade {{$loop->first ? 'show active' : ''}} " id="tab-{{$cat->id}}" role="tabpanel" aria-labelledby="home{{$cat->id}}-tab">
                                    @php $faqs =$this->faqs($cat->id)  @endphp
                                    @foreach($faqs as $faq)
                                    <div class="accordion-item">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{$faq->id}}" aria-expanded="true" aria-controls="faq{{$faq->id}}"> {{$this->getTranslate('title',$faq)}}</button>
                                        <div id="faq{{$faq->id}}" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                {{$this->getTranslate('content',$faq)}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>




                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End FAQ Area -->
            <livewire:front.layout.footer :language="$multiLanguage">


                </div>