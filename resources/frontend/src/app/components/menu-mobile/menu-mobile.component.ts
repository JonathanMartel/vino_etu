import { Component, OnInit } from '@angular/core';
import { AuthService } from '@services/auth.service';

@Component({
  selector: 'app-menu-mobile',
  templateUrl: './menu-mobile.component.html',
  styleUrls: ['./menu-mobile.component.scss']
})
export class MenuMobileComponent implements OnInit {

  constructor(private servAuth: AuthService) { }

  ngOnInit(): void {
  }

  deconnexion() {

    //let token= localStorage.getItem('token');
    //console.log(token);
    this.servAuth.deconnexion().subscribe(resp =>{
      console.log(resp)})

  }


}
