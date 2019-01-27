import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-prisoners-list',
  templateUrl: './prisoners-list.component.html',
  styleUrls: ['./prisoners-list.component.css']
})
export class PrisonersListComponent implements OnInit {
<<<<<<< HEAD:Frontend/src/app/components/content/prisoners-list/prisoners-list.component.ts
  headerOfSite = 'Więźniowie';
  prisoners = [1, 2, 3, 4, 5, 6, 7, 'janek'];
=======
  headerOfSite = "Więźniowie";
  prisoners=[1,2,3,4,5,6,7,"janek"];
>>>>>>> 771277e... components moved to correct files:Frontend/src/app/components/content/prisoners-list/prisoners-list.component.ts
  constructor() { }

  ngOnInit() {
  }

}
