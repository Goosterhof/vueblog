<template>
 
  <div class="submitCommentContainer">

    <b-form @submit.prevent="submitComment(articleId)">
       <b-form-group style="margin-top: 30px" label="your name:" label-for="input-username">
           <b-form-input style="width: 350px;" id="input-username" v-model="commentForm.name" required></b-form-input>
       </b-form-group>
      
      <b-form-group label="your comment:" label-for="input-comment">
           <b-form-textarea style="height: 200px; width: 350px;" id="input-comment" v-model="commentForm.body" required></b-form-textarea>
       </b-form-group>

       <b-button style="margin-top: 10px;" type="submit" variant="primary">Submit</b-button>

    </b-form>

    <!-- new comment -->
    <transition-group name="fade">
        <div v-for="comment in newComments" :key="comment.id">
            <div class="commentContainer" v-if="newComment">
                <p>{{comment.body}}</p>
                <div class="replyButtonsContainer">
                    <div @click="toggleReplyForm(comment.id)" class="replyButton">reply</div>
                    <div @click="toggleReplies(comment.id)" class="showRepliesButton">{{comment.replies.length}} Replies</div>
                </div>
                <p style="text-align: right;">{{comment.username}}</p>
            </div>
             <div class="replyContainer" v-if="isReplyFormShowing[comment.id]">
              <b-form @submit.prevent="submitReply(comment.id)">
                <b-form-group style="" label="your name:" label-for="input-reply-username">
                    <b-form-input  style="" id="input-reply-username" v-model="replyForm.name" required></b-form-input>
                </b-form-group>
                
                <b-form-group label="your comment:" label-for="input-reply-comment">
                    <b-form-textarea style="resize: none" id="input-reply-comment" v-model="replyForm.body" required></b-form-textarea>
                </b-form-group>

                <b-button style="margin-top: 10px;" type="submit" variant="primary">Submit</b-button>
                <b-button @click="hideReplyForm(comment.id)" style="margin-top: 10px;" variant="secondary">Cancel</b-button>
              </b-form>
          </div>
           <div v-if="areRepliesShowing[comment.id]">
              <div v-for="reply in comment.replies" :key="reply.id">
                <div class="repliesContainer" >
                    <p>{{reply.body}}</p>
                    <p style="text-align: right;">{{reply.username}}</p>
                </div>
              </div>
          </div>
        </div>
        </transition-group>
    

  <div class="commentsContainer">
      <div v-for="(comment, index) in comments" :key="comment.id">
          <div :class="{pushFooter: index === comments.length-1}"  class="commentContainer">
              <p>{{comment.body}}</p>
              <div class="replyButtonsContainer">
                <div @click="toggleReplyForm(comment.id)" class="replyButton">reply</div>
                <div @click="toggleReplies(comment.id)" class="showRepliesButton">{{comment.replies.length}} Replies</div>
              </div>
              <p style="text-align: right;">{{comment.username}}</p>
          </div>
          <div class="replyContainer" v-if="isReplyFormShowing[comment.id]">
              <b-form @submit.prevent="submitReply(comment.id)">
                <b-form-group style="" label="your name:" label-for="input-reply-username">
                    <b-form-input  style="" id="input-reply-username" v-model="replyForm.name" required></b-form-input>
                </b-form-group>
                
                <b-form-group label="your comment:" label-for="input-reply-comment">
                    <b-form-textarea style="resize: none" id="input-reply-comment" v-model="replyForm.body" required></b-form-textarea>
                </b-form-group>

                <b-button style="margin-top: 10px;" type="submit" variant="primary">Submit</b-button>
                <b-button @click="hideReplyForm(comment.id)" style="margin-top: 10px;" variant="secondary">Cancel</b-button>
              </b-form>
          </div>
          <div v-if="areRepliesShowing[comment.id]">
              <div v-for="reply in comment.replies" :key="reply.id">
                <div class="repliesContainer" >
                    <p>{{reply.body}}</p>
                    <p style="text-align: right;">{{reply.username}}</p>
                </div>
              </div>
          </div>
      </div>
  </div>
  
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {

    name: "Comments",
    props: {
        articleId: { 
            type: Number,
            required: true
        },
    },
    
    data(){
        return {
            newComment: false,
            newReply: false,
            isReplyFormShowing: {},
            areRepliesShowing: {},
            commentForm: {
                name: "",
                body: ""
            },
            replyForm: {
                name: "",
                body: "",
            }
            
        }
    },

    computed: {
        ...mapState(["newComments", "comments"])
    },
    mounted() {
        this.$store.commit("CLEAR_STATE")
    },
    

    methods: {
        submitComment(articleId){
            this.$store.dispatch("submitComment", {articleId: articleId, name: this.commentForm.name, body: this.commentForm.body})
            this.commentForm.name = ""
            this.commentForm.body = ""
            this.newComment = true
        },
        submitReply(commentId){
            this.$store.dispatch("submitReply", {commentId: commentId, name: this.replyForm.name, body: this.replyForm.body})
            this.replyForm.name = ""
            this.replyForm.body = ""
            this.hideReplyForm(commentId)
            this.toggleReplies(commentId)
        },
        toggleReplyForm(commentId){
            console.log(commentId)
            if(this.isReplyFormShowing[commentId]){
                this.isReplyFormShowing[commentId] = false
            } else{
                this.$set(this.isReplyFormShowing, commentId, true)
            }
            
        },
        hideReplyForm(commentId){

            this.isReplyFormShowing[commentId] = false
        },
        toggleReplies(commentId){
            // for(const key of Object.keys(this.replies[commentId])){
            //     console.log(this.replies[commentId][key])
            // }
            if(this.areRepliesShowing[commentId]){
                this.areRepliesShowing[commentId] = false
            } else {
                this.$set(this.areRepliesShowing, commentId, true)
            }
            
        }
    },
}
</script>

<style>

.submitCommentContainer {
    margin-top: 50px;
    width: 700px;
    border-top: 1px solid black;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding-bottom: 50px;
}

.commentContainer {
    margin-top: 50px;
    max-width: 700px;
    box-shadow: 2px 2px 2px 2px grey;
    padding: 5px 5px 0px 5px;
}

.replyButtonsContainer {

    height: 30px;
    width: 150px;
    display: flex;
    justify-content: space-between;
    position: absolute;
}

.replyButton {
    font-weight: bold;
    cursor: pointer;
}

.showRepliesButton {
    color: blue;
    font-weight: 600;
    cursor: pointer;
}

.replyContainer {
    width: 600px;
    height: 200px;
    margin-left: 100px;
    margin-bottom: 50px;
}

.repliesContainer {
    width: 600px;
    margin-left: 100px;
    box-shadow: 2px 2px 2px 2px grey;
    padding: 5px 5px 0px 5px;
}


.fade-enter-active, .fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}



</style>