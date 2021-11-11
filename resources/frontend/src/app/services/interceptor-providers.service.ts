import { HTTP_INTERCEPTORS } from "@angular/common/http";

import { HttpXsrfInterceptor } from "./http-xsrf.interceptor"

export const interceptorProviders = [
    {
        provide: HTTP_INTERCEPTORS,
        useClass: HttpXsrfInterceptor,
        multi: true
    },
]
