spacelampsix.profile = spacelampsix.profile || {};
spacelampsix.profile.show = spacelampsix.profile.show || {};

spacelampsix.profile.show = {
    boot: function () {
        $(document).on('click', '.add-new-game-button', function(e) {
            e.preventDefault();

            const url = '/' + $('#auth_user_username').val() + '/favorite_game/store';
            console.log(url);
            axios.post(url, {
                'game_id': $(this).data('id'),
                'game_title': $(this).data('name'),
                'box_art_url': $(this).data('art-url'),
            })
            .then(response => {
                if (response.status === 200) {
                    $(this).removeClass('btn-primary');
                    $(this).addClass('btn-secondary');
                    $(this).find('i').removeClass('fa fa-plus');
                    $(this).find('i').addClass('fa fa-check');
                    $(this).attr('disabled', true);

                    $(this).parent().append(
                        '<button type="button" class="col-auto d-flex justify-content-end btn btn-sm btn-dark m-2 remove-game-button" data-id="'+$(this).data('id')+'"><i class="fa fa-times"></i></button>'
                    );
                    
                    //reactive :)
                    $('.favorite-game-images').append(
                        '<img class="m-2" src="https://static-cdn.jtvnw.net/ttv-boxart/'+$(this).data('id')+'-285x380.jpg" />'
                    );
                }
            }).catch(error => {
                $(this).parent().append(
                    '<span class="text-danger">You can not have more than 9 favorite games.</span>'
                );
            })
        });
    },
}