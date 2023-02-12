<div>
    <livewire:front.layout.menu :lang="$multiLanguage">
        <livewire:front.blog.title />
        <!-- End Page Title Area -->
        <!-- Start Blog Area -->
        <div class="blog-area ptb-100">
            <div class="container">
                <livewire:front.blog.index :blog="[$multiLanguage,$blog]" />
            </div>
        </div>
        <!-- End Blog Area -->
    <livewire:front.layout.footer :language="$multiLanguage">
</div>


