<template>
  <div>
    <br />
    <el-form ref="loginForm" :model="loginData" label-position="top">
      <el-form-item
        label="Username"
        label-width="100px"
        prop="username"
        :rules="[
          {
            required: true,
            message: 'Please input username!',
            trigger: 'blur'
          }
        ]"
      >
        <el-input v-model="loginData.username" />
      </el-form-item>
      <el-form-item
        label="Password"
        label-width="100px"
        prop="password"
        :rules="[
          {
            required: true,
            message: 'Please input password!',
            trigger: 'blur'
          }
        ]"
      >
        <el-input v-model="loginData.password" type="password" autocomplete="off" show-password />
      </el-form-item>

      <el-row justify="end">
        <el-form-item>
          <el-button size="large" @click="login">Log in</el-button>
        </el-form-item>
      </el-row>
    </el-form>
  </div>
</template>

<script>
import { ElMessage, extractTimeFormat } from 'element-plus'
import { useStore } from 'vuex'

export default {
  data() {
    return {
      loginData: {
        username: '',
        password: ''
      }
    }
  },
  methods: {
    async login() {
      this.$refs['loginForm'].validate(async (valid) => {
        if (!valid) {
          ElMessage({
            message: 'Check form for errors',
            type: 'error'
          })
        } else {
          var response = await this.post('/login', {
            username: this.loginData,
            password: this.loginData.password
          })

          console.log('Response:', response)
          // console.log(this.response)
          // const store = useStore()
          // store.dispatch('login')
        }
      })
    },
    logout() {
      const store = useStore()
      store.dispatch('logout')
    }
  }
}
</script>
