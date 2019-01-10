import { Component, OnInit } from '@angular/core';
import { LoginService } from '../services/login.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  headerOfSite = "Aktualnosci";
  infos=[1,2,3,4,5,6,7,8];
  constructor( private loginServ: LoginService) { }

  ngOnInit() {
    this.loginServ.checkLogin().subscribe(
      elem=>console.log(elem),
      err=>console.log(err)
    )
  }

}
