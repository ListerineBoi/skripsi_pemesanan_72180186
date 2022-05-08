<template>
  <ul class="list-group">
    <li class="list-group-item list-group-item-action flex-column align-items-start" v-for="room in rooms" :key="room.id" @click="chooseId(room.id)">
      <div class="row">
        <div class="col-4">
          <img class="img-fluid mr-4" v-if="room.jasa.detp.jenis== 0" :src="'/img/tnb.png'" alt="image">
          <img class="img-fluid mr-4" v-else-if="room.jasa.detp.jenis== 1" :src="'/img/top.png'" alt="image">
          <img class="img-fluid mr-4" v-else-if="room.jasa.detp.jenis== 2" :src="'/img/bottom.png'" alt="image">
          <img class="img-fluid mr-4" v-else-if="room.jasa.detp.jenis== 3" :src="'/img/dress.png'" alt="image">
        </div>
        <div class="col-8">
          <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1" v-if="room.jasa.jenis_jasa== 0"> <strong>Sampling</strong> : {{room.jasa.detp.nama_atasan}} - {{room.jasa.detp.nama_bawahan}}</h5>
              <h5 class="mb-1" v-if="room.jasa.jenis_jasa== 1"> <strong>Produksi</strong> : {{room.jasa.detp.nama_atasan}} - {{room.jasa.detp.nama_bawahan}}</h5>
              <small v-if="room.messageslatest!=null">{{room.messageslatest.created_at}}</small>
          </div>
          <p class="mb-1 text-dark"  v-if="room.messageslatest!=null">New Message: {{room.messageslatest.message}}</p>
          <small v-if="room.jenis==0">Konsultasi Produksi/Sampling</small>
          <small v-if="room.jenis==1">Konsultasi Paska-Produksi/Sampling</small>
        </div>
        <button type="submit" class="btn btn-danger mt-3 ml-3" @click="submitdel(room.id)">Delete</button>
      </div>
    </li>
    <li class="list-group-item list-group-item-action flex-column align-items-start" >
        <div class="d-flex justify-content-center" data-toggle="modal" data-target="#exampleModalLong">
            <h2 class="mb-1"><i class="ti-plus"></i></h2>
            
        </div>
    </li>
    <div class="modal fade" id="exampleModalLong">
      <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buka Room Baru</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                     <label class="col-form-label">Jenis</label>
                    <select class="custom-select mb-2" v-model="selectedJ" name="model">
                        <option  value="0">Konsultasi Produksi/Sampling</option>
                        <option  value="1">Komplain Paska-Produksi/Sampling</option>
                    </select>
                    <label class="col-form-label" v-if="selectedJ!=2">Tipe Jasa</label>
                    <select class="custom-select mb-2" v-if="selectedJ!=2" v-model="selectedT" name="model">
                        <option  value="0">Produksi</option>
                        <option  value="1">Sampling</option>
                        
                    </select>
                    <label class="col-form-label" v-if="selectedT!=null && selectedJ!=2">Subyek</label>
                    <select class="custom-select mb-2" v-if="selectedT==0 && selectedJ!=2" v-model="selectedP" name="model">
                        <option v-for="produksi in jasas.produksi" :value="produksi.id" :key="produksi.id">{{produksi.detp.nama_atasan}} - {{produksi.detp.nama_bawahan}}</option>
                    </select>

                    <select class="custom-select mb-2" v-if="selectedT==1 && selectedJ!=2" v-model="selectedS" name="model">
                        <option v-for="sampling in jasas.sampling" :value="sampling.id" :key="sampling.id">{{sampling.detp.nama_atasan}} - {{sampling.detp.nama_bawahan}}</option>
                    </select>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" v-if="selectedJ==2" @click="submitroom(2)">Save changes</button>
                    <button type="submit" class="btn btn-primary" v-else-if="selectedJ==0" @click="submitroom(0)">Save changes</button>
                    <button type="submit" class="btn btn-primary" v-else-if="selectedJ==1" @click="submitroom(1)">Save changes</button>
                    
                  
                </div>
            </div>
        </div>
    </div>
  </ul>

</template>
<script>
export default {
  //Takes the "user" props from <chat-form> … :user="{{ Auth::user() }}"></chat-form> in the parent chat.blade.php.
  props: ["rooms","jasas"],
  data() {
    return {
      room: "",
      selectedJ: '',
      selectedT: '',
      selectedS: '',
      selectedP: '',
    };
  },
  methods: {
    chooseId(value) {
      this.$emit("chooseroom", {
        room: value,
      });
      
      
    },
    submitdel(rmid) {
      this.$emit("dlroom", {
        rm_id: rmid,
      });
      //console.log(rmid)
      
    },
    submitroom(value) {
      switch (value) {
        case 0:
          if(this.selectedT==0){
            this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:this.selectedT,
              jasa_id: this.selectedP,
            });
          }else if(this.selectedT==1){
            this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:this.selectedT,
              jasa_id: this.selectedS,
            });
          }
          break;
        case 1:
          if(this.selectedT==0){
            this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:this.selectedT,
              jasa_id: this.selectedP,
            });
          }else if(this.selectedT==1){
            this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:this.selectedT,
              jasa_id: this.selectedS,
            });
          }
          break;
        case 2:
          this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:null,
              jasa_id: null,
          });
          break;
      }
      
      
    },
  },
};
</script>