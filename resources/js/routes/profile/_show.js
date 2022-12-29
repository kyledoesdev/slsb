spacelampsix.profile = spacelampsix.profile || {};
spacelampsix.profile.show = spacelampsix.profile.show || {};

spacelampsix.profile.show = {
    boot: function () {
        $('#submit-game-input').on('click', function (e) {
            e.preventDefault();

            if ($('.queried-images').length > 0) {
                $('.queried-images').empty();
            }

            const url = '/twitch/get-categories';
            const search_term = $('#game-input').val();

            if (search_term && search_term != '') {
                axios.get(url, {
                    params: {
                        'search-term': search_term,
                    }
                })
                .then(response => {
                    const data = response.data;
                    if (data.length > 0) {
                        data.forEach(element => {
                            const label = '<h4 class="col-sm-auto d-flex justify-content-start mt-2 mb-2">'+element['name']+'</h4>';
                            const image = '<img src="https://static-cdn.jtvnw.net/ttv-boxart/'+element["id"]+'-285x380.jpg" value="'+element['id']+'" class="searched-image" width="142.5" height="190"/>';
                            const button = '<button type="button" class="col-auto d-flex justify-content-end btn btn-sm btn-primary m-2 add-new-game-button" data-id="'+element['id']+'" data-name="'+element['name']+'" data-art-url="'+element['box_art_url']+'"><i class="fa fa-plus"></i></button>';
                            $('.queried-images').append(
                                '<div class="col mx-2">\
                                    '+image+'\
                                    <div class="row"> \
                                    '+label+'\
                                    '+button+'\
                                    </div> \
                                </div>'
                            );
                        });
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            }
        });

        $('#reset').on('click', function(e) {
            e.preventDefault();
            if ($('.queried-images').length > 0) {
                $('.queried-images').empty();
            }

            $('#game-input').val('');
        });

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