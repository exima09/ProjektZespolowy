import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  constructor(private router: Router) { }

  ngOnInit() {
  }
<<<<<<< HEAD:Frontend/src/app/components/menu/menu.component.ts

  goToPrisoners() {
    this.router.navigateByUrl('/prisoners');
=======
  
  goToPrisoners() {
    this.router.navigateByUrl("/prisoners")
>>>>>>> 771277e... components moved to correct files:Frontend/src/app/components/menu/menu.component.ts
  }
}
