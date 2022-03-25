<template>
  <ul class="chat ">
    <li class="left clearfix" v-for="room in rooms" :key="room.id" @click="chooseId(room.id)">
      <div class="clearfix">
        <div class="header">
          <strong>
            room {{ room.id }}
          </strong>
        </div>
        <div class="input-group " >
          <input id="btn-input" type="hidden" name="room" class="form-control" :value="room.id" >
          <span class="input-group-btn ">
          </span>
        </div>
      </div>
    </li>
    <li>
      <div class="header">
          <strong>
          ashdkjadhkadkj
          </strong>
        </div>
    </li>
  </ul>
</template>
<script>
export default {
  //Takes the "user" props from <chat-form> … :user="{{ Auth::user() }}"></chat-form> in the parent chat.blade.php.
  props: ["rooms"],
  data() {
    return {
      room: "",
    };
  },
  methods: {
    chooseId(value) {
      this.$emit("chooseroom", {
        room: value,
      });
      
      
    },
  },
};
</script>