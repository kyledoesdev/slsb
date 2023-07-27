import swal from 'sweetalert';

export default {
    methods: {
        flash(title, messgae, level = 'success') {
            return swal(title, messgae, level);
        },

        doubleCheck(title, extraText = null, icon = 'warning', showCancelButton = true, confirmButtonText = 'Yes, delete it!') {
            swal({
                title: title,
                text: extraText,
                icon: icon,
                showCancelButton: showCancelButton,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText
            }).then((result) => {
                if (result.isConfirmed) {
                  flash('Deleted!', 'Deleted successfully.')
                  return true;
                }

                return false;
            });
        }
    }
}