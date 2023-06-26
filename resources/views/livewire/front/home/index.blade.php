<div>
    <livewire:front.layout.menu :lang="$multiLanguage">
    <livewire:front.module.top :setting="$setting" />
    <livewire:front.module.feature :setting="[$multiLanguage,$setting]" />
    <livewire:front.module.about :setting="[$multiLanguage,$setting]" />
    <livewire:front.module.feature2 :setting="[$multiLanguage,$setting]" />
    <livewire:front.module.screen />
    <livewire:front.module.video :setting="[$multiLanguage,$setting]"/>
    <livewire:front.module.counter />
    <livewire:front.module.download :setting="$setting"/>
    <livewire:front.module.customer />
     <livewire:front.module.pack :setting="[$multiLanguage,$setting]"/>
    <livewire:front.module.blog :lang="$multiLanguage" />
    <livewire:front.layout.footer :language="$multiLanguage">
</div>
