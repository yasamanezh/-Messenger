<div>
      <livewire:front.layout.menu :lang="$multiLanguage">
    <livewire:front.page.layout.title :title="$this->getTranslate('title',$page)" />   
    {!! $this->getTranslate('content', $page) !!}
    @if($page->use_app_module)
      <livewire:front.module.download1 />
    @endif
        <livewire:front.layout.footer :language="$multiLanguage">
</div>
