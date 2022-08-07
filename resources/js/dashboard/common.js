console.log('in');
let was_checked = 0;

let checkbox = document.getElementById('featured_checkbox');
checkbox.addEventListener('change', () => {
    if (was_checked === 0) {
        was_checked = 1;
        confirm('Are you sure you want to make this post featured? It will un-feature your current featured post.');
    }
});
