<template>
  <div>
    <div class="uk-container">
      <vk-card>
        <vk-card-title>สมัคร มหาสุรนารี ศรีคทากร รุ่นที่ 7</vk-card-title>
        <form class="uk-form-stacked">
          <div class="uk-margin">
            <label class="uk-form-label" for="firstName">ชื่อจริง</label>
            <div class="uk-form-controls">
              <input class="uk-input" id="firstName" type="text" placeholder="">
            </div>
          </div>
          <div class="uk-margin">
            <label class="uk-form-label" for="lastName">นามสกุล</label>
            <div class="uk-form-controls">
              <input class="uk-input" id="lastName" type="text" placeholder="">
            </div>
          </div>
          <div class="uk-margin">
            <label class="uk-form-label" for="enrollAge">อายุ</label>
            <div class="uk-form-controls">
              <input class="uk-input" type="number" id="enrollAge" min="18" max="30"/>
            </div>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label" for="faculty">สำนักวิชา</label>
              <div class="uk-form-controls">
                <select class="uk-select" id="faculty">
                  <option value="" disabled>กรุณาเลือก</option>
                </select>
              </div>
          </div>
          <div class="uk-margin">
            <label class="uk-form-label" for="subFaculty">สาขาวิชา และ หลักสูตร</label>
            <div class="uk-form-controls">
              <select class="uk-select" id="subFaculty">
                <option value="" disabled>กรุณาเลือก</option>
              </select>
            </div>
          </div>
          <div class="uk-margin">
            <label class="uk-form-label" for="reasonToBeKatakorn">ทำไมถึงอยากมาเป็นคทากร</label>
            <div class="uk-form-controls">
              <textarea class="uk-input" id="reasonToBeKatakorn"></textarea>
            </div>
          </div>
        </form>
      </vk-card>
    </div>
  </div>
</template>

<script>
export default {
  name: "Enroll",
  metaInfo: {
    title: "Katakorn 7 Enrollment"
  }
}
</script>

<style scoped>

</style>
