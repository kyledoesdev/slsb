<template>
    <section>
        <div class="btn-group">
            <button :class="upratingButton" @click="vote" data-type="up">
                <i class="fa-solid fa-arrow-up"></i><span class="p-1 text-dark">{{ votes }}</span>
            </button>
            <button :class="downRatingButton" @click="vote" data-type="down">
                <i class="fa-solid fa-arrow-down"></i>
            </button>
            <a 
                class="btn btn-outline-dark pt-1 pb-1" 
                data-bs-toggle="modal" 
                :data-bs-target="getReplyModalString" 
                style="text-decoration: none; cursor: pointer;"
            >
                <span class="mt-1"><i class="fa-regular fa-message p-0"></i><span class="mx-1">Reply</span></span>
            </a>
            <button class="btn btn-sm btn-primary btn-outline-dark" 
                :value="id" 
                data-bs-toggle="modal" 
                :data-bs-target="editCommentModalString"
                v-if="this.authuser === this.commentuser"
            >
                <i class="fa-solid fa-pencil"></i>
            </button>
            <button class="btn btn-sm btn-danger btn-outline-dark delete-comment" 
                :value="id" 
                :form="deleteCommentModalString"
                v-if="this.authuser === this.commentuser"
            >
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['id', 'commentuser', 'authuser', 'vote_count', 'hasrating', 'uprating', 'downrating'],

        data: function() {
            return {
                id: this.id,
                votes: this.vote_count,
                status: this.hasrating,
                up_status: this.uprating,
                down_status: this.downrating,
            }
        },

        methods: {
            vote(event) {
                let type = event.target.closest('button').dataset.type;
                
                axios.post('/comment/'+this.id+'/rate', {
                    'up': type == 'up',
                    'down': type == 'down',
                    'type': type,
                    'vote_count': this.vote_count,
                })
                .then(response => {
                    if (response.data && response.data.commentRating) {
                        let data = response.data.commentRating;
                        let rating_type = data.rating_type;
                        let vote_count = response.data.vote_count;

                        if (rating_type == 'up') {
                            this.up_status = true;
                            this.down_status = false;
                        } else if (rating_type == 'down') {
                            this.up_status = false;
                            this.down_status = true;
                        } else {
                            this.up_status = false;
                            this.down_status = false;
                        }

                        this.votes = vote_count; 
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            },
        },

        computed: {
            upratingButton() {
                return this.up_status 
                    ? 'btn btn-primary border border-1 border-dark pt-1 pb-1'
                    : 'btn btn-outline-primary border border-1 border-dark pt-1 pb-1';
            },

            getReplyModalString() {
                return '#add-reply-'+this.id;
            },

            downRatingButton() {
                return this.down_status
                    ? 'btn btn-secondary border border-1 border-dark pt-1 pb-1'
                    : 'btn btn-outline-secondary border border-1 border-dark pt-1 pb-1';
            },

            editCommentModalString() {
                return "#edit-comment-" + this.id;
            },

            deleteCommentModalString() {
                return "delete-comment-" + this.id;
            }
        },
    }

</script>