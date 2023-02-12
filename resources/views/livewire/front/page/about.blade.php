<div>
     <livewire:front.layout.menu :lang="$multiLanguage">
    <livewire:front.page.layout.title :title="$this->getTranslate('title',$page)" />
    <div class="ptb-100">
        <livewire:front.module.about />
    </div>
    <livewire:front.page.layout.counter />
    
    {!! $this->getTranslate('content', $page) !!}
      <livewire:front.page.layout.customer />
          <livewire:front.layout.footer :language="$multiLanguage">

    
</div>
