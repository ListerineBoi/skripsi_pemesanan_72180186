<template>
  <ul class="chat ">
    <li class="left clearfix" v-for="message in messages" :key="message.id">
      <div class="clearfix">
        <div class="header">
          <strong v-if="message.user!=null">
            {{ message.user.name }}
          </strong>
          <strong v-else>
            {{ message.admin.name }}
          </strong>
        </div>
        <p>
          {{ message.message }}
        </p>
      </div>
    </li>
  </ul>
</template>
<script>
export default {
  props: ["messages"],
};
</script>