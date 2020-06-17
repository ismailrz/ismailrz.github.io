<template>
    <div> 
        <div class="search-sec">
            <div class="container">
              <div class="search-box">
                <form>
                  <input type="text" name="search" placeholder="Search keywords">
                  <button type="submit">Search</button>
                </form>
              </div><!--search-box end-->
            </div>
        </div><!--search-sec end-->
    </div>
</template>
<script>
export default {
    name: 'JobTopSearchbar',
    data() {
      return { 
        name: "",
        url: null,
        events: false,
        myEvent: false,
        invitationReceived: false,
     };   
   },
  mounted() {
      this.url = window.location.href.split('/').pop();

       if(this.url == 'events'){
            if(JSON.parse(localStorage.getItem('tag')) == 'my_event'){
              this.myEvent = true;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'invitation_received'){
              this.invitationReceived = true;
            }else{
              this.events = true;
            }
       }
      //  JSON.parse(localStorage.getItem('tag'))
  },
   methods:{
     set_content_type(contentType){
    
         localStorage.setItem('tag', JSON.stringify(contentType));
          if(JSON.parse(localStorage.getItem('tag')) == 'my_event'){
              this.events = false;
              this.myEvent = true;
              this.invitationReceived = false;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'invitation_received'){
              this.events = false;
              this.myEvent = false;
              this.invitationReceived = true;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'events'){
              this.events = true;
              this.myEvent = false;
              this.invitationReceived = false;
            }
       if(this.url != 'events'){
         this.$router.push("/events");
       }else{
         this.$emit('setContentType');
       }
     }
   }
}
</script>