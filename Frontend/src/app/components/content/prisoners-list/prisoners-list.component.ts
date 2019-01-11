import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-prisoners-list',
  templateUrl: './prisoners-list.component.html',
  styleUrls: ['./prisoners-list.component.css']
})
export class PrisonersListComponent implements OnInit {
  headerOfSite = "Więźniowie";
  prisoners=[1,2,3,4,5,6,7,"janek"];
  constructor() { }

  ngOnInit() {
  }

}
