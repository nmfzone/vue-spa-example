<template>
  <div>
    <div class="event-lists">
      <div class="event-card" v-for="event in events">
        <div class="poster-card">
          <a href="#" class="poster-card__main">
            <div class="poster-card__header">
              <div class="poster-card__image">
                <img class="poster-image" :src="event.poster.file_url" alt="#" />
              </div>
              <span class="poster-card__label">Free</span>
            </div>
            <div class="poster-card__body">
              <time class="poster-card__date">{{ moment(event.created_at).format('LLLL') }}</time>
              <div class="poster-card__title">
                  {{ event.title }}
              </div>
              <div class="poster-card__venue">
                Yogyakarta
              </div>
            </div>
          </a>
          <div class="poster-card__footer">
            <div class="poster-card__tags">
              <a href="#">#{{ event.category.slug }}</a>
            </div>
            <div class="poster-card__actions">
              <a class="share-action" href="#">
                <i class="ico-share ico--medium"></i>
                <span class="hidden">Share this event</span>
              </a>
              <a class="bookmark" title="Save" href="#">
                <i class="ico-bookmark ico--medium"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        events: null
      }
    },
    mounted() {
      axios.get(`/api/v1/events`)
        .then(({data}) => {
          this.events = data.data
        }).catch(error => {
          console.log(error)
        })
    }
  }
</script>

<style lang="scss" scoped>
  div {
    margin: 0;
    padding: 0;
  }

  .event-card {
    padding: 15px;
    box-sizing: border-box;
    display: inline-block;
    overflow: hidden;
    vertical-align: top;
    width: 33.3%;
  }

  .poster-card {
    transform: translate3d(0,0,0);
    transition: box-shadow .2s cubic-bezier(0,.2,.4,1);
    background-color: #f8f8fa;
    box-shadow: 0 1px 0 0 rgba(0,0,0,.1);
    display: block;

    > a {
      &:hover {
        text-decoration: none;
      }
    }

    .poster-card__main {
      display: block;
    }

    .poster-card__header {
      position: relative;
      line-height: 0;

      &:before {
        display: block;
        content: "\00A0";
        width: 100%;
        padding-top: 50%;
      }

      &::after {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 1px;
        display: block;
        content: "\00A0";
        width: 100%;
        background: #EFF2F5;
      }

      .poster-card__image {
        transition: background-color .5s;
        overflow: hidden;
        text-align: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;

        img {
          max-width: 100%;
          transform: translateY(-50%);
          position: relative;
          top: 50%;
        }
      }

      .poster-card__label {
        background-color: #fff;
        background-color: rgba(255,255,255,.92);
        text-transform: uppercase;
        font-size: 12px;
        line-height: 18px;
        color: #282C35;
        box-sizing: border-box;
        padding: 2px 10px;
        position: absolute;
        display: inline-block;
        top: 10px;
        right: 10px;
      }
    }

    .poster-card__body {
      padding: 5px 15px;

      .poster-card__date {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        display: block;
        color: #45494E;
        font-size: 11px;
        line-height: 25px;
        height: 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 5px 0 0;
      }

      .poster-card__title {
        display: -webkit-box;
        max-height: 38px;
        margin: 0 auto;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #282C35;
        font-size: 15px;
        line-height: 19px;
        max-height: 38px;
        font-weight: 600;
        letter-spacing: 0;
        padding: 0;
        height: 38px;
      }

      .poster-card__venue {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        color: #666A73;
        font-size: 12px;
        line-height: 25px;
        height: 25px;
        padding: 5px 0 0;
      }
    }

    .poster-card__footer {
      position: relative;
      height: 40px;
      line-height: 40px;
      padding-right: 80px;
      border-top: 1px solid #EFF2F5;
      padding-left: 15px;
    }
  }
</style>
