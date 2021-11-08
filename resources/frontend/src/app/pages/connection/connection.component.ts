import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { AuthService } from '@services/auth.service';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
    selector: 'app-connection',
    templateUrl: './connection.component.html',
    styleUrls: ['./connection.component.scss']
})
export class ConnectionComponent implements OnInit {

    formConnection = new FormGroup({
        email: new FormControl('', [Validators.required, Validators.email]),
        password: new FormControl('', Validators.required)
    });


    constructor(
        private servAuth: AuthService,
        private http: HttpClient,
        private router: Router,
        private snackbar: MatSnackBar,
    ) { }

    ngOnInit(): void {
    }

    get erreur() {
        return this.formConnection.controls;
    }

    connection() {
        const data = {
            email: this.formConnection.value.email,
            password: this.formConnection.value.password
        }

        this.servAuth.connexion(data).subscribe(
            (data) => {
                console.log(data);
                this.servAuth.utilisateur = data.utilisateur;
                this.servAuth.token = data.token;
                this.snackbar.open(`Salut, ${data.utilisateur.first_name} !`, "Fermer", {duration: 3000});
            },
            (error) => {
                this.snackbar.open(error.error.message, "Fermer", {duration: 3000});
            })
    }

}
