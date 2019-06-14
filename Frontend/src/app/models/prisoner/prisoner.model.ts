import {Cell} from "../cell/cell.model";
import { Execution } from "../execution/execution.model";
import { Visit } from "../visit/visit.model";
import { SickLeave } from "../sick-leave/sickLeave.model";
import { JailJobSchedule } from "../jail-job-schedule/jail-job-schedule";

export class Prisoner {
    id?: number;
    firstName: string;
    lastName: string;
    joinDate: string;
    dateOfBirth: string;
    cell: Cell;
    executions: Execution[];
    visits: Visit[];
    sickLeaves: SickLeave[];
    jailJobSchedules: JailJobSchedule[];
}
