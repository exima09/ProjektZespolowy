import { Component, OnInit } from '@angular/core';
import { Execution } from 'src/app/models/execution/execution.model';
import { ExecutionService } from 'src/app/services/execution/execution.service';

@Component({
  selector: 'app-execution-list',
  templateUrl: './execution-list.component.html',
  styleUrls: ['./execution-list.component.css']
})
export class ExecutionListComponent implements OnInit {
  headerOfSite = "Lista egzekucji";
  executions: Execution[];

  constructor(private executionService: ExecutionService) {
  }

  ngOnInit() {
    this.executionService.getExecutions().subscribe((res: any) => {
      this.executions = JSON.parse(res.execution);
      console.log(this.executions);
      this.executions.sort((a, b) => new Date(b.executionDate).getTime() - new Date(a.executionDate).getTime());
    });
  }

  sortByDateUp() {
    console.log("działa");
    this.executions.sort((a, b) => new Date(b.executionDate).getTime() - new Date(a.executionDate).getTime());
  }

  sortByDateDown() {
    this.executions.sort((a, b) => new Date(a.executionDate).getTime() - new Date(b.executionDate).getTime());
  }

  sortByPrisonerAZ() {
    this.executions.sort((a, b) => a.prisoner.lastName.localeCompare(b.prisoner.lastName));
  }

  sortByPrisonerZA() {
    this.executions.sort((a, b) => b.prisoner.lastName.localeCompare(a.prisoner.lastName));
  }

}
