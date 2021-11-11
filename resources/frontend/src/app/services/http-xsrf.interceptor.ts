import { Injectable } from '@angular/core';
import {
    HttpRequest,
    HttpHandler,
    HttpEvent,
    HttpInterceptor,
    HttpXsrfTokenExtractor
} from '@angular/common/http';

import { Observable } from 'rxjs';

@Injectable()


export class HttpXsrfInterceptor implements HttpInterceptor {
    private nomEntete: string = "X-XSRF-TOKEN";

    constructor(
        private extractor: HttpXsrfTokenExtractor,
    ) { }

    intercept(
        request: HttpRequest<unknown>,
        next: HttpHandler): Observable<HttpEvent<unknown>> {

        console.log("j'intercepte");

        if (request.method === 'GET' || request.method === 'HEAD') {
            return next.handle(request);
        }

        const xToken = this.extractor.getToken();

        if (xToken === null || request.headers.has(this.nomEntete)) {
            return next.handle(request);
        }

        request = request.clone({ headers: request.headers.set(this.nomEntete, xToken) });

        return next.handle(request);
    }
}
