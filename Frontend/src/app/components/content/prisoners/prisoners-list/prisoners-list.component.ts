import {Component, OnInit} from '@angular/core';
import {PrisonerService} from "../../../../services/prisoner/prisoner.service";
import {Prisoner} from "../../../../models/prisoner/prisoner.model";

@Component({
  selector: 'app-prisoners-list',
  templateUrl: './prisoners-list.component.html',
  styleUrls: ['./prisoners-list.component.css']
})
export class PrisonersListComponent implements OnInit {
  headerOfSite = 'Więźniowie';
  prisoners: Prisoner[] = [];
  constructor(private service: PrisonerService) {}

  ngOnInit() {
    this.service.getPrisoners().subscribe((res: any) => {
      this.prisoners = JSON.parse(res.prisoners);
    });
  }
}
