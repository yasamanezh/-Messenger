<div>
    <livewire:front.page.layout.title :title="$this->getTranslate('title',$module)" />
    <div class="ptb-100">
        <livewire:front.module.about />
    </div>
    <livewire:front.page.layout.counter />
    
    {!! $this->getTranslate('content', $page) !!}
      <livewire:front.page.layout.customer />

    
</div>
