<script>
    let posts = @json(array_values($postsPerMonth));
    let months = @json(array_keys($postsPerMonth));
    let trans = {
        chartLabel: "{{ __('Post History')  }}",
        new: "{{ __('ថ្មី') }}",
        post: "{{ __('បង្ហោះ') }}",
        posts: "{{ __('បង្ហោះ') }}"
    };
</script>

{!! HTML::script('assets/js/chart.min.js') !!}
{!! HTML::script('assets/js/as/dashboard-post.js') !!}
