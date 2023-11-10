export default {
    data() {
        return {
            'currentRoute': $('#page_name').val(),
            'authUser': JSON.parse($('#auth_user').val()),
        }
    }
}