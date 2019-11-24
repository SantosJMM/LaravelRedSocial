<template>
    <div class="card border-0 mb-3 shadow-sm" >
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center mb-3">
                <img class="rounded mr-3 shadow-sm" width="40px" :src="status.user.avatar" :alt="status.user.name">
                <div class="">
                    <h5 class="mb-1"><a :href="status.user.link" v-text="status.user.name"/></h5>
                    <div class="small text-muted" v-text="status.ago"></div>
                </div>
            </div>
            <p class="card-text text-secondary" v-text="status.body"/>
        </div>
        <div class="card-footer p-2 d-flex justify-content-between align-items-center">
            <like-btn dusk="like-btn" :url="`/statuses/${status.id}/likes`" :model="status"/>

            <div class="text-secondary mr-2">
                <i class="far fa-thumbs-up"/>
                <span dusk="likes-count">{{ status.likes_count }}</span>
            </div>
        </div>

        <div class="card-footer">
            <div v-for="comment in comments" class="mb-2">
                <div class="d-flex">
                    <img class="rounded shadow-sm mr-2" width="34px" height="34px" :src="comment.user.avatar" :alt="comment.user.name">
                    <div class="flex-grow-1">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2 text-secondary">
                                <a :href="comment.user.link"><strong>{{ comment.user.name }} ||</strong></a>
                                {{ comment.body }}
                            </div>
                        </div>

                        <small class="badge badge-pill badge-primary py-1 px-2 mt-1 float-right" dusk="comment-likes-count">
                            <i class="fa fa-thumbs-up"/>
                            {{ comment.likes_count }}
                        </small>
                        <like-btn
                            dusk="comment-like-btn"
                            :url="`/comments/${comment.id}/likes`"
                            :model="comment"
                            class="comments-like-btn"
                        />
                    </div>
                </div>
            </div>

            <form @submit.prevent="addComment" v-if="isAuthenticated">
                <div class="d-flex align-items-center">
                    <img class="rounded shadow-sm mr-2" width="34px" :src="currentUser.avatar" :alt="currentUser.name">
                    <div class="input-group">
                        <textarea v-model="newComment"
                                  class="form-control border-0 shadow-sm"
                                  name="comment"
                                  id="comment"
                                  placeholder="Escribe un comentario..."
                                  rows="1"
                                  required
                        />
                        <div class="input-group-append">
                            <button class="btn btn-primary" dusk="comment-btn">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import LikeBtn from "./LikeBtn"

    export default {
        components:{
            LikeBtn
        },
        props: {
            status: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                newComment: '',
                comments: this.status.comments
            }
        },
        methods: {
            addComment() {
                axios.post(`statuses/${this.status.id}/comments`, {body: this.newComment})
                    .then(res => {
                        this.newComment = '';
                        this.comments.push(res.data.data);
                    })
                    .catch(err => {
                        console.log(err.response.data);
                    })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .comments-like-btn{
        font-size: 0.6em;
        padding-left: 0;
        i { display: none;}
    }
</style>
