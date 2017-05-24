const { mix } = require('laravel-mix');
const path = require('path');
const root = path.resolve(__dirname);


/*
 |--------------------------------------------------------------------------
 | Extended Mix Configuration
 |--------------------------------------------------------------------------
 |
 | Here we define our custom Configuration.
 |
 */

mix.webpackConfig({
    resolve: {
        alias: {
          '@root': `${root}/resources/assets/js`,
          '@base': `${root}/resources/assets/js/components`,
          '@common': `${root}/resources/assets/js/components/common`,
          '@config': `${root}/resources/assets/js/components/config`,
          '@common-auth': `${root}/resources/assets/js/components/common/auth`,
          '@common-form': `${root}/resources/assets/js/components/common/form`,
          '@common-functions': `${root}/resources/assets/js/components/common/functions`,
          '@middleware': `${root}/resources/assets/js/components/middleware`,
          '@router': `${root}/resources/assets/js/components/router`,
          '@pages': `${root}/resources/assets/js/components/pages`,
          '@shared': `${root}/resources/assets/js/components/shared`,
          '@store': `${root}/resources/assets/js/components/store`,
        }
    }
});
