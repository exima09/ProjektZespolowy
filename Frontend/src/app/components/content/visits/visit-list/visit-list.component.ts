import { Component, OnInit } from '@angular/core';
import {Visit} from "../../../../models/visit/visit.model";
import {VisitService} from "../../../../services/visit/visit.service";
import * as moment from "moment";

@Component({
  selector: 'app-visit-list',
  templateUrl: './visit-list.component.html',
  styleUrls: ['./visit-list.component.css']
})
export class VisitListComponent implements OnInit {
  headerOfSite = "Lista odwiedzin"
  visitToday: Visit[] = [];
  visitMonth: Visit[] = [];
  visitAll: Visit[] = [];

  constructor(private service: VisitService) { }

  ngOnInit() {
    this.loadVisit();
  }

  loadVisit = () => this.service.getVisits().subscribe(
    (res:any)=> {
      this.visitAll = JSON.parse(res.visits);
      this.visitToday = this.visitAll.filter(v =>
        moment(new Date()).hour(0).minute(0).unix() <
        moment(v.dateStart).unix() && moment(v.dateStart).unix() <
        moment(new Date()).hour(0).minute(0).add(1, 'days').unix()
      )
      this.visitMonth = this.visitAll.filter(v =>
        moment(new Date()).day(1).hour(0).minute(0).unix() <
        moment(v.dateStart).unix() && moment(v.dateStart).unix() <
        moment(new Date()).day(30).hour(0).minute(0).add(1, 'days').unix()
      )
    }
  )

  getContact=(visit: Visit)=> visit.contactType === "P"
    ? `telefon: ${visit.contact}`
    : `e-mail: ${visit.contact}`;

  getStatus = (statusAccepted: boolean) => statusAccepted ? "Potwierdzona" : "Niepotwierdzona";

  acceptVisit = (id) => {
    this.service.updateStatus(id, {statusAccepted: true}).subscribe(res => this.loadVisit())
  }
}
