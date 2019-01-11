import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  login:string
  constructor() { }

  ngOnInit() {
  }

  writtenLogin(value){
    this.login=value;
    console.log(this.login);
  }

}
