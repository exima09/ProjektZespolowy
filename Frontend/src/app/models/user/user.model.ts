import {Worker} from "../worker/worker.model";
import {Role} from "../role/role";

export class User {
  id?: number;
  username: string;
  password: string;
  roles: Role[];
  firstName: string;
  lastName: string;
  worker: Worker;
}
