<div>
@section('title',__('Languages'))
   <!-- Start Page Title Area -->
        <livewire:front.blog.title />
        <!-- End Page Title Area -->

        <!-- Start Blog Area -->
        <div class="blog-area ptb-100">
            <div class="container">
                <livewire:front.blog.index :blog="$blog" />
            </div>
        </div>
        <!-- End Blog Area -->

</div>

