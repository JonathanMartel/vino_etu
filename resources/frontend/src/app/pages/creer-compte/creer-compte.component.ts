import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, NgForm, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
    selector: 'app-creer-compte',
    templateUrl: './creer-compte.component.html',
    styleUrls: ['./creer-compte.component.scss']
})
export class CreerCompteComponent implements OnInit {

    rempli = false;
    soumise = false;

    formulaire = new FormGroup({
        first_name: new FormControl('', [Validators.required, Validators.minLength(3)]),
        last_name: new FormControl('', [Validators.required, Validators.minLength(3)]),
        city: new FormControl('', [Validators.required]),
        dob: new FormControl('', [Validators.required]),
        email: new FormControl('', [Validators.required, Validators.email]),
        password: new FormControl('', Validators.required)
    });

    constructor(private servBouteilleDeVin: BouteilleDeVinService, private router: Router) { }

    ngOnInit(): void {
    }

    get erreur() {
        return this.formulaire.controls;
    }

    utilisateur() {
        console.log(this.formulaire.value);
        this.soumise = true;

        if (this.formulaire.invalid) {
            this.formulaire.markAllAsTouched();
            return;
        }
        this.rempli = true;

        const data = {
            first_name: this.formulaire.value.first_name,
            last_name: this.formulaire.value.last_name,
            city: this.formulaire.value.city,
            dob: this.formulaire.value.dob,
            email: this.formulaire.value.email,
            password: this.formulaire.value.password
        }
        this.servBouteilleDeVin.ajouterUtilisateur(data).subscribe((res) => {
            this.router.navigate(['/connection']);
        });

    }

}


