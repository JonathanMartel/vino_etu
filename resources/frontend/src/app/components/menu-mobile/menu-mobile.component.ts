import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '@services/auth.service';

@Component({
    selector: 'app-menu-mobile',
    templateUrl: './menu-mobile.component.html',
    styleUrls: ['./menu-mobile.component.scss']
})
export class MenuMobileComponent implements OnInit {

    constructor(private servAuth: AuthService, private router: Router) { }

    ngOnInit(): void {
    }

    deconnexion() {
        this.servAuth.deconnexion();
        this.router.navigate(['/connection']);
    }

    estAuthentifie() {
        return this.servAuth.estAuthentifie();
    }
}
